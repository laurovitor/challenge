const { compareSync } = require("bcryptjs");
const { sign } = require("jsonwebtoken");
const Validator = require("cpf-cnpj-validator");
const { customerSchema, mongoose } = require("../models");

const controller = () => {
    // Autenticação de usuário por email/senha
    const postAuthenticate = async (req, res) => {
        const { email, password } = req.body;
        const customer = await customerSchema.findOne({ email }).select("+password");

        if (!customer) return res.status(400).send({ error: "Email não encontrado." });

        if (!compareSync(password, customer.password))
            return res.status(400).send({ error: "Senha inválida." });

        customer.password = undefined;
        customer.createdAt = undefined;
        customer.updatedAt = undefined;

        const token = sign({ customer }, "606cb46aea30425bdff4f6f7a32453e2", {
            expiresIn: 31536000
        });

        return res.status(200).send({ token });
    };

    // Retorna lista de todos os usuários no banco
    const getCustomer = async (req, res) => {
        //200 (OK), 404 (Not Found)
        const { id } = req.params;
        // Valida se o id é um ObjectId se for consulta o id no bando caso contrario lista todos os usuários do banco.
        const customer = await customerSchema.find(mongoose.Types.ObjectId.isValid(id) ? { _id: id } : null);

        if (!customer)
            return res.status(400).send({ error: "Usuário não encontrado." });

        return res.status(200).send({ customer: customer });
    };

    // Cria um novo usuário no banco
    const postCustomer = async (req, res) => {
        //201 (Created), 404 (Not Found), 409 (Conflict)
        const { name, email, password, cpf } = req.body;
        try {
            if (!Validator.cpf.isValid(cpf))
                return res.status(400).send({ error: "Informe um CPF valido." });

            if (await customerSchema.findOne({ email }))
                return res.status(400).send({ error: "Email já cadastrado." });

            if (await customerSchema.findOne({ cpf }))
                return res.status(400).send({ error: "CPF já cadastrado." });

            const customer = await customerSchema.create({ name, email, password, cpf });
            customer.password = undefined;

            return res.send({ customer });
        } catch (err) {
            console.error(err)
            return res.status(400).send({ error: "Falha no registro de usuário." });
        }
    };

    // Atualiza um usuário no banco
    const patchCustomer = async (req, res) => {
        //200 (OK), 204 (No Content), 404 (Not Found)
        const { id } = req.params;
        const { email, cpf } = req.body;

        if (!mongoose.Types.ObjectId.isValid(id))
            return res.status(400).send({ error: "Informe um ID valido." });

        if (await customerSchema.findOne({ email }))
            return res.status(400).send({ error: "Email já cadastrado." });

        if (await customerSchema.findOne({ cpf }))
            return res.status(400).send({ error: "CPF já cadastrado." });

        customerSchema.findByIdAndUpdate(id, req.body, (err, customer) => {
            if (err)
                return res.status(400).send({ error: "Falha ao atualizar usuário." });

            if (!customer)
                return res.status(400).send({ error: "Usuário não encontrado." });

            return res.send({ success: `${req.body.name ? req.body.name : customer.name} atualizado com sucesso.`, customer });
        });
    };

    // Deleta um usuário no banco
    const deleteCustomer = async (req, res) => {
        //200 (OK), 404 (Not Found)
        const { id } = req.params;
        if (!mongoose.Types.ObjectId.isValid(id))
            return res.status(400).send({ error: "Informe um ID valido." });

        customerSchema.findByIdAndRemove(id, (err, customer) => {
            if (err)
                return res.status(400).send({ error: "Não foi possível remover este usuário." });

            if (!customer)
                return res.status(400).send({ error: "Usuário não encontrado." });

            return res.status(200).send({ success: `${customer.name} removido com sucesso.` });
        });
    };

    return {
        postAuthenticate: postAuthenticate,
        getCustomer: getCustomer,
        postCustomer: postCustomer,
        patchCustomer: patchCustomer,
        deleteCustomer: deleteCustomer
    };
};

module.exports = controller;
