const mongoose = require("../database");
const { hashSync } = require("bcryptjs");

const CustomerSchema = new mongoose.Schema(
  {
    cpf: {
      type: Number,
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
    }
  },
  { timestamps: true }
);

CustomerSchema.pre("save", (next) => {
  const hash = hashSync(this.password);
  this.password = hash;
  next();
});

module.exports = mongoose.model("Customer", CustomerSchema);
