const { Router } = require("express");
const router = Router();

const { customer, middleware } = require("../controllers")();

// ---------------------------------------------------------
// Rotas Independentes
// ---------------------------------------------------------

// ---------------------------------------------------------
// Rotas não autenticadas
// ---------------------------------------------------------
router.route('/authenticate').post(customer.postAuthenticate);

// ---------------------------------------------------------
// Middleware
// ---------------------------------------------------------
router.use(middleware.validateToken);

// ---------------------------------------------------------
// Rotas autenticadas
// ---------------------------------------------------------
router.route('/:id?')
    .get(customer.getCustomer)
    .post(customer.postCustomer)
    .delete(customer.deleteCustomer)
    .patch(customer.patchCustomer);

module.exports = router;
