const { verify } = require("jsonwebtoken");

const controller = () => {
    const validateToken = (req, res, next) => {
        const authHeader = req.headers.authorization;

        if (!authHeader)
            return res.status(401).send({ error: "Token não informado." });

        const parts = authHeader.split(" ");

        if (!parts.length === 2)
            return res.status(401).send({ error: "Token error." });

        const [scheme, token] = parts;

        if (!/^Bearer$/i.test(scheme))
            return res.status(401).send({ error: "Formato de token inválido." });

        verify(token, "606cb46aea30425bdff4f6f7a32453e2", (err, decoded) => {
            if (err) return res.status(401).send({ error: "Token inválido." });

            req.customer = decoded.customer;
            return next();
        });
    };

    return {
        validateToken: validateToken
    };
};

module.exports = controller;
