const customer = require("./customer")();
const product = require("./product")();
const order = require("./order")();
const middleware = require("./middleware")();

const controller = () => {
    const getIndex = (req, res, next) => {
        res.render('index', {
            title: 'API',
            style: "signin.css"
        });
    };

    return {
        getIndex: getIndex,
        middleware: middleware,
        customer: customer,
        product: product,
        order: order
    };
};

module.exports = controller;