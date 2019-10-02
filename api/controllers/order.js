const controller = () => {
    const postOrder = (req, res) => {
        res.status(200).send();
    };

    const patchOrder = (req, res) => {
        res.status(200).send();
    };

    const deleteOrder = (req, res) => {
        res.status(200).send();
    };

    const getOrder = (req, res) => {
        res.status(200).send();
    };

    return {
        postOrder: postOrder,
        patchOrder: patchOrder,
        deleteOrder: deleteOrder,
        getOrder: getOrder
    };
};

module.exports = controller;
