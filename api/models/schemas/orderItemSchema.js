const mongoose = require("../database");

const ItemSchema = new mongoose.Schema(
    {
        product: { type: mongoose.Schema.ObjectId, ref: 'Product' },
        order: { type: mongoose.Schema.ObjectId, ref: 'Order' },
        amount: {
            type: Number
        },
        price_unit: {
            type: Number
        },
        total: {
            type: Number
        }
    },
    { timestamps: true }
);

module.exports = mongoose.model("Item", ItemSchema);