const customerSchema = require("./schemas/customerSchema");
const productSchema = require("./schemas/productSchema");
const orderSchema = require("./schemas/orderSchema");
const orderItemSchema = require("./schemas/orderItemSchema");
const mongoose = require("./database");

module.exports = { customerSchema, productSchema, orderSchema, orderItemSchema, mongoose };
