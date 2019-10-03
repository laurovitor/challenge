const { productSchema, mongoose } = require("../models");

const controller = () => {
    const postProduct = (req, res) => {
        res.status(200).send();
    };

    const patchProduct = (req, res) => {
        res.status(200).send();
    };

    const deleteProduct = (req, res) => {
        res.status(200).send();
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
