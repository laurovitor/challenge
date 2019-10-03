const { productSchema, mongoose } = require("../models");

const controller = () => {
    const postProduct = async (req, res) => {
        const { name, sku, price } = req.body;
        const customerLoggedIn = req.customer;

        try {
            if (!customerLoggedIn.manager)
                return res.status(400).send({ error: "Usuário não autorizado." });

            if (name.length < 3)
                return res.status(400).send({ error: "O Nome esta muito curto." });

            if (!sku)
                return res.status(400).send({ error: "Informe um SKU." });

            if (!price)
                return res.status(400).send({ error: "Informe um valor." });

            if (await productSchema.findOne({ sku }))
                return res.status(400).send({ error: "SKU já cadastrado." });

            productSchema.create({ name, sku, price }, (err, product) => {
                if (err)
                    return res.status(400).send({ error: "Falha ao registra o produto." });

                return res.send({ product });
            });
        } catch (err) {
            console.error(err)
            return res.status(400).send({ error: "Falha no registro de produto." });
        }
    };

    const patchProduct = async (req, res) => {
        const { id } = req.params;
        const { name, sku, price } = req.body;
        const customerLoggedIn = req.customer;

        if (!mongoose.Types.ObjectId.isValid(id))
            return res.status(400).send({ error: "Informe um ID valido." });

        if (!customerLoggedIn.manager)
            return res.status(400).send({ error: "Usuário não autorizado." });

        if (name.length < 3)
            return res.status(400).send({ error: "O Nome esta muito curto." });

        if (await productSchema.findOne({ sku }))
            return res.status(400).send({ error: "SKU já cadastrado." });

        if (!price)
            return res.status(400).send({ error: "Informe um valor." });

        productSchema.findByIdAndUpdate(id, req.body, (err, product) => {
            if (err)
                return res.status(400).send({ error: "Falha ao atualizar produto." });

            if (!product)
                return res.status(400).send({ error: "Produto não encontrado." });

            return res.send({ success: `${req.body.name ? req.body.name : product.name} atualizado com sucesso.`, product });
        });
    };

    const deleteProduct = (req, res) => {
        const { id } = req.params;
        const customerLoggedIn = req.customer;

        if (!mongoose.Types.ObjectId.isValid(id))
            return res.status(400).send({ error: "Informe um ID valido." });

        if (!customerLoggedIn.manager)
            return res.status(400).send({ error: "Usuário não autorizado." });

        productSchema.findByIdAndRemove(id, (err, product) => {
            if (err)
                return res.status(400).send({ error: "Não foi possível remover este produto." });

            if (!product)
                return res.status(400).send({ error: "Produto não encontrado." });

            return res.status(200).send({ success: `${product.name} removido com sucesso.` });
        });
    };

    const getProduct = async (req, res) => {
        const { id } = req.params;
        const customerLoggedIn = req.customer;

        if (!customerLoggedIn.manager)
            return res.status(400).send({ error: "Usuário não autorizado." });

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
