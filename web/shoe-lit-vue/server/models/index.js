const Sequelize = require('sequelize');

const sequelize = new Sequelize({
  dialect : 'postgres',
  database: 'shoelit',
  username: 'postgres',
  password: 'Techtastic1206'
});

module.exports = {
  default: sequelize
};
