const { Router } = require("express");
const router = Router();

// ---------------------------------------------------------
// Rotas Independentes
// ---------------------------------------------------------

// ---------------------------------------------------------
// Rotas não autenticadas
// ---------------------------------------------------------
router.get("/", (req, res) => { res.status(404).send(); });

// ---------------------------------------------------------
// Middleware
// ---------------------------------------------------------


// ---------------------------------------------------------
// Rotas autenticadas
// ---------------------------------------------------------

module.exports = router;
