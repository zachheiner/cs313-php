const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

const ShoeColorway = require('./ShoeColorway').default;
const ShoeBrand    = require('./ShoeBrand').default;
const ShoeModel    = require('./ShoeModel').default;

class Shoe extends Sequelize.Model {}

Shoe.init({
  brand: {
    type      : Sequelize.INTEGER,
    references: {
      model: ShoeBrand,
      key  : 'id'
    }
  },
  model: {
    type      : Sequelize.INTEGER,
    references: {
      model: ShoeModel,
      key  : 'id'
    }
  },
  colorway: {
    type      : Sequelize.INTEGER,
    references: {
      model: ShoeColorway,
      key  : 'id'
    }
  }
}, { sequelize, modelName: 'shoe' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: Shoe
};
