const controller = () => {
    const postProducts = (req, res) => {
        res.status(200).send();
    };

    const putProducts = (req, res) => {
        res.status(200).send();
    };

    const patchProducts = (req, res) => {
        res.status(200).send();
    };

    const deleteProducts = (req, res) => {
        res.status(200).send();
    };

    const getProducts = (req, res) => {
        res.status(200).send();
    };

    return {
        postProducts: postProducts,
        putProducts: putProducts,
        patchProducts: patchProducts,
        deleteProducts: deleteProducts,
        getProducts: getProducts
    };
};

module.exports = controller;
