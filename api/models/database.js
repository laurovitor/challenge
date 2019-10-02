const mongoose = require('mongoose');

const db = {
    username: process.env.DB_USER || "root",
    password: process.env.DB_PASS || "root",
    database: process.env.DB_NAME || "challenge",
    host: process.env.DB_HOST || "localhost",
    port: process.env.DB_PORT || "27017"
}

const uri = `mongodb://${db.username}:${db.password}@${db.host}:${db.port}/${db.database}`;

const options = {
    useNewUrlParser: true,
    useCreateIndex: true,
    useFindAndModify: false,
    useUnifiedTopology: true
};

mongoose.connect(uri, options, (err) => {
    console.log(err);
});

mongoose.Promise = global.Promise;
/*
dbm = mongoose.connection;
dbm.on('error', err => {
    console.log('Ocorreu um erro ao conectar com a database.');
});
dbm.once('connected', () => {
    console.log('Conectado ao MongoDB');
});
dbm.once('disconnected', () => {
    console.log('Desconectado do MongoDB');
});
process.on('SIGINT', () => {
    mongoose.connection.close(() => {
        console.log('dBase connection closed due to app termination');
        process.exit(0);
    });
});
*/
module.exports = mongoose;
