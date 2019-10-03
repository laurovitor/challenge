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

router.route('/').post(customer.postCustomer);

// ---------------------------------------------------------
// Middleware
// ---------------------------------------------------------
router.use(middleware.validateToken);

// ---------------------------------------------------------
// Rotas autenticadas
// ---------------------------------------------------------
router.route('/:id?')
    .get(customer.getCustomer)
    .delete(customer.deleteCustomer)
    .patch(customer.patchCustomer);

module.exports = router;
