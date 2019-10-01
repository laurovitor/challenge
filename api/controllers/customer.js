const { compareSync } = require("bcryptjs");
const { sign } = require("jsonwebtoken");
const Validator = require("cpf-cnpj-validator");
const models = require("../models");

const controller = () => {
    // Autenticação de usuário por email/senha
    const postAuthenticate = async (req, res) => {
        const { email, password } = req.body;
        const customer = await models.customerSchema.findOne({ email }).select("+password");

        if (!customer) return res.status(400).send({ error: "Email não encontrado." });

        if (!compareSync(password, customer.password))
            return res.status(400).send({ error: "Senha inválida." });

        customer.password = undefined;
        customer.createdAt = undefined;
        customer.updatedAt = undefined;

        const token = sign({ customer }, "606cb46aea30425bdff4f6f7a32453e2", {
            expiresIn: 31536000
        });

        return res.send({ token });
    };

    // Retorna lista de todos os usuários no banco
    const getCustomers = async (req, res) => {
        const id = req.params.id ? req.params.id : req.customer._id;
        const customer = await id ? models.customerSchema.findById(id) : models.customerSchema.find({});

        if (!customer)
            return res.status(400).send({ error: "Usuário não encontrado." });

        return res.send({ customer: customer });
    };

    // Cria um novo usuário no banco
    const postCustomers = async (req, res) => {
        const { name, email, password, cpf } = req.body;
        try {
            if (await models.customerSchema.findOne({ email }))
                return res.status(400).send({ error: "Email já cadastrado." });
            else if (!Validator.cpf.isValid(cpf))
                return res.status(400).send({ error: "Informe um CPF valido." });
            else if (await models.customerSchema.findOne({ cpf }))
                return res.status(400).send({ error: "CPF já cadastrado." });

            const customer = await models.customerSchema.create({ name, email, password, cpf });
            customer.password = undefined;

            return res.send({ customer });
        } catch (error) {
            return res.status(400).send({ error: "Falha no registro de usuário." });
        }
    };

    return {
        postAuthenticate: postAuthenticate,
        getCustomers: getCustomers,
        postCustomers: postCustomers
    };
};

module.exports = controller;
