const mongoose = require("../database");

const OrderSchema = new mongoose.Schema(
  {
    customer: { type: mongoose.Schema.ObjectId, ref: 'Customer' },
    total: {
      type: String,
      required: true
    },
    status: {
      type: String,
      required: true
    },
    items: [{
      product: { type: mongoose.Schema.ObjectId, ref: 'Product' },
      amount: {
        type: Number
      },
      price_unit: {
        type: Number
      },
      total: {
        type: Number
      }
    }]
  },
  { timestamps: true }
);

module.exports = mongoose.model("Order", OrderSchema);
