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
      item: { type: mongoose.Schema.ObjectId, ref: 'Item' },
      createdAt: { type: Date, default: Date.now }
    }]
  },
  { timestamps: true }
);

module.exports = mongoose.model("Order", OrderSchema);
