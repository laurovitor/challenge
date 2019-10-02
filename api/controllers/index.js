const customer = require("./customer")();
const product = require("./product")();
const order = require("./order")();
const middleware = require("./middleware")();

const models = require("../models");

const controller = () => {
    const getIndex = (req, res, next) => {
        res.render('index', {
            title: 'API',
            style: "signin.css"
        });
    };

    const postIndex = (req, res, next) => {

    };

    const getDashboard = (req, res, next) => {

    };

    const postDashboard = (req, res, next) => {

    };

    const getRegister = (req, res, next) => {
        res.render('register', {
            title: 'API - Cadastro',
            style: "form-validation.css"
        });
    };

    const postRegister = (req, res, next) => {
        console.log(req.body);
    };

    return {
        getIndex: getIndex,
        postIndex: postIndex,
        getDashboard: getDashboard,
        postDashboard: postDashboard,
        getRegister: getRegister,
        postRegister: postRegister,
        middleware: middleware,
        customer: customer,
        product: product,
        order: order
    };
};

module.exports = controller;