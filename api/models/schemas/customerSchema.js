const mongoose = require("../database");
const { hashSync } = require("bcryptjs");

const CustomerSchema = new mongoose.Schema(
  {
    cpf: {
      type: String,
      required: true,
      unique: true,
    },
    email: {
      type: String,
      required: true,
      unique: true,
      lowercase: true
    },
    password: {
      type: String,
      required: true,
      select: false
    },
    name: {
      type: String,
      required: true,
    },
    manager: {
      type: Boolean,
      default: false,
      select: false
    }
  },
  { timestamps: true }
);

CustomerSchema.pre("save", async function (next) {
  const hash = await hashSync(this.password);
  this.password = hash;
  next();
});

module.exports = mongoose.model("Customer", CustomerSchema);
