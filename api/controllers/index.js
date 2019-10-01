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

    const postIndex = (req, res, next) => {

    }

    const getDashboard = (req, res, next) => {

    }

    const postDashboard = (req, res, next) => {

    }

    return {
        getIndex: getIndex,
        postIndex: postIndex,
        getDashboard: getDashboard,
        postDashboard: postDashboard,
        middleware: middleware,
        customer: customer,
        product: product,
        order: order
    };
};

module.exports = controller;