const { orderSchema, orderItemSchema, mongoose } = require("../models");

const controller = () => {
    const postOrder = (req, res) => {
        const { customerId } = req.params;
        const { total, status, items } = req.body;

        if (!mongoose.Types.ObjectId.isValid(customerId))
            return res.status(400).send({ error: "Informe um ID valido." });

        try {

            orderSchema.create({ customer: customerId, total, status, items }, (err, order) => {
                if (err)
                    return res.status(400).send({ error: "Falha ao registra o pedido." });

                return res.send({ order });
            });
        } catch (err) {
            console.error(err)
            return res.status(400).send({ error: "Falha no registro de pedido." });
        }
    };

    const patchOrder = (req, res) => {
        const { orderId, customerId } = req.params;
        const customerLoggedIn = req.customer;
        const { status } = req.body;

        if (!customerLoggedIn.manager || customerLoggedIn._id !== customerId)
            return res.status(400).send({ error: "Usuário não autorizado." });

        if (!mongoose.Types.ObjectId.isValid(orderId))
            return res.status(400).send({ error: "Informe um ID valido." });

        orderSchema.findByIdAndUpdate(orderId, { status: status }, (err, order) => {
            if (err)
                return res.status(400).send({ error: "Não foi possível atualizar este pedido." });

            if (!order)
                return res.status(400).send({ error: "Pedido não encontrado." });

            return res.status(200).send({ success: true });
        });
    };

    const deleteOrder = (req, res) => {
        const { orderId } = req.params;
        const customerLoggedIn = req.customer;

        if (!customerLoggedIn.manager)
            return res.status(400).send({ error: "Usuário não autorizado." });

        if (!mongoose.Types.ObjectId.isValid(orderId))
            return res.status(400).send({ error: "Informe um ID valido." });

        orderSchema.findByIdAndRemove(orderId, (err, order) => {
            if (err)
                return res.status(400).send({ error: "Não foi possível remover este pedido." });

            if (!order)
                return res.status(400).send({ error: "Pedido não encontrado." });

            return res.status(200).send({ success: true });

        });
    };

    const getOrder = async (req, res) => {
        const { customerId, orderId } = req.params;
        const filters = {};

        if (mongoose.Types.ObjectId.isValid(orderId))
            filters._id = orderId;

        if (mongoose.Types.ObjectId.isValid(customerId))
            filters.customer = customerId;

        const order = await orderSchema.find(filters);

        console.log(order);
        console.log(filters);

        if (!order || order.length < 1)
            return res.status(400).send({ error: "Nenhum pedido encontrado." });

        return res.status(200).send({ orders: order });
    };

    return {
        postOrder: postOrder,
        patchOrder: patchOrder,
        deleteOrder: deleteOrder,
        getOrder: getOrder
    };
};

module.exports = controller;
