const controller = () => {
    const putOrders = (req, res) => {
        res.status(200).send();
    };

    const postOrders = (req, res) => {
        res.status(200).send();
    };

    return {
        putOrders: putOrders,
        postOrders: postOrders
    };
};

module.exports = controller;
