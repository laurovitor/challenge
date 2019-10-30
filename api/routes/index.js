const { Router } = require('express');
const customerRoute = require("./customer");
const productRoute = require("./product");
const orderRoute = require("./order");

const controller = require("../controllers")();

const router = Router();

// ---------------------------------------------------------
// Rotas Independentes
// ---------------------------------------------------------
router.use('/customer', customerRoute);
router.use('/product', productRoute);
router.use('/order', orderRoute);

// ---------------------------------------------------------
// Rotas não autenticadas
// ---------------------------------------------------------
router.route('/').get(controller.getIndex);

// ---------------------------------------------------------
// Middleware
// ---------------------------------------------------------
router.use(controller.middleware.validateToken);

// ---------------------------------------------------------
// Rotas autenticadas
// ---------------------------------------------------------

module.exports = router;
