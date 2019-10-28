const { Router } = require("express");
const router = Router();

const { order, middleware } = require("../controllers")();

// ---------------------------------------------------------
// Rotas Independentes
// ---------------------------------------------------------

// ---------------------------------------------------------
// Rotas não autenticadas
// ---------------------------------------------------------

// ---------------------------------------------------------
// Middleware
// ---------------------------------------------------------
router.use(middleware.validateToken);

// ---------------------------------------------------------
// Rotas autenticadas
// ---------------------------------------------------------
router.route('/:customerId/:orderId?')
    .get(order.getOrder)
    .post(order.postOrder)
    .delete(order.deleteOrder)
    .patch(order.patchOrder);

module.exports = router;