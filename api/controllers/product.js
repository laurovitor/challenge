const { productSchema, mongoose } = require("../models");

const controller = () => {
    const postProduct = (req, res) => {
        res.status(200).send();
    };

    const patchProduct = (req, res) => {
        res.status(200).send();
    };

    const deleteProduct = (req, res) => {
        const { id } = req.params;
        const customerLoggedIn = req.customer;

        if (!mongoose.Types.ObjectId.isValid(id))
            return res.status(400).send({ error: "Informe um ID valido." });

        if (!customerLoggedIn.manager)
            if (id !== customerLoggedIn._id)
                return res.status(400).send({ error: "Usuário não autorizado." });

        productSchema.findByIdAndRemove(id, (err, product) => {
            if (err)
                return res.status(400).send({ error: "Não foi possível remover este produto." });

            if (!product)
                return res.status(400).send({ error: "Usuário não encontrado." });

            return res.status(200).send({ success: `${product.name} removido com sucesso.` });
        });
    };

    const getProduct = async (req, res) => {
        const { id } = req.params;
        // Valida se o id é um ObjectId se for consulta o id no bando caso contrario lista todos os produtos do banco.
        const product = await productSchema.find(mongoose.Types.ObjectId.isValid(id) ? { _id: id } : null);

        if (!product)
            return res.status(400).send({ error: "Produto não encontrado." });

        return res.status(200).send({ products: product });
    };

    return {
        postProduct: postProduct,
        patchProduct: patchProduct,
        deleteProduct: deleteProduct,
        getProduct: getProduct
    };
};

module.exports = controller;
