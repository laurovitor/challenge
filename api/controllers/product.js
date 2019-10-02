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

    const getProduct = (req, res) => {
        res.status(200).send();
    };

    return {
        postProduct: postProduct,
        patchProduct: patchProduct,
        deleteProduct: deleteProduct,
        getProduct: getProduct
    };
};

module.exports = controller;
