const { Router } = require("express");
const router = Router();

const { product, middleware } = require("../controllers")();

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
router.route('/:id?')
    .get(product.getProduct)
    .post(product.postProduct)
    .delete(product.deleteProduct)
    .patch(product.patchProduct);

module.exports = router;