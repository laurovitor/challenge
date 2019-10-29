const { orderSchema, orderItemSchema, mongoose } = require("../models");

const controller = () => {
    const postOrder = (req, res) => {
        const { customer, total, status, items } = req.body;

        // receber dados e criar novo pedido, apos
        // adicionar o pedido incluir os produtos do
        // pedido e retornar pedido populado para o cliente

        res.status(200).send();
    };

    const patchOrder = (req, res) => {

        // altera o status do pedido

        res.status(200).send();
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

        });
    };

    const getOrder = async (req, res) => {
        const { customerId, orderId } = req.params;

        // Valida se o id é um ObjectId se for consulta o id no bando caso contrario lista todos os pedidos do banco.
        const filters = {};

        if (mongoose.Types.ObjectId.isValid(orderId))
            filters._id = orderId;

        if (mongoose.Types.ObjectId.isValid(customerId))
            filters.customer = customerId;

        const order = await orderSchema.find(filters);

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
