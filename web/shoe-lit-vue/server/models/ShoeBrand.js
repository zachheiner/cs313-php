const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

class ShoeBrand extends Sequelize.Model {}

ShoeBrand.init({
  name: Sequelize.STRING
}, { sequelize, modelName: 'shoe-brand' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: ShoeBrand
};
