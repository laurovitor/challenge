const mongoose = require("../database");

const ProductSchema = new mongoose.Schema(
    {
        sku: {
            type: Number,
            required: true,
            unique: true
        },
        name: {
            type: String,
            required: true,
            unique: true,
        },
        price: {
            type: String,
            required: true,
        }
    },
    { timestamps: true }
);

module.exports = mongoose.model("Product", ProductSchema);
