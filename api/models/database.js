const mongoose = require("mongoose");

const username = process.env.DB_USER || "root";
const password = process.env.DB_PASS || "example";
const database = process.env.DB_NAME || "api";
const host = process.env.DB_HOST || "db-mongo";
const port = process.env.DB_PORT || "27017";

mongoose.connect(
    `mongodb://${username}:${password}@${host}:${port}/${database}`,
    { useCreateIndex: true, useNewUrlParser: true }
);

mongoose.Promise = global.Promise;

module.exports =  mongoose;
