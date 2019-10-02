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
router.route('/')
  .get(controller.getIndex)
  .post(controller.postIndex);

router.route('/register')
  .get(controller.getRegister)
  .post(controller.postRegister);

// ---------------------------------------------------------
// Middleware
// ---------------------------------------------------------
router.use(controller.middleware.validateToken);

// ---------------------------------------------------------
// Rotas autenticadas
// ---------------------------------------------------------
router.route('/dashboard')
  .get(controller.getDashboard)
  .post(controller.postDashboard);

module.exports = router;
