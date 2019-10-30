const customerSchema = require("./schemas/customerSchema");
const productSchema = require("./schemas/productSchema");
const orderSchema = require("./schemas/orderSchema");
const mongoose = require("./database");

module.exports = { customerSchema, productSchema, orderSchema, mongoose };
