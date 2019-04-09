const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

const ShoeBrand = require('./ShoeBrand.js').default;

class ShoeModel extends Sequelize.Model {}

ShoeModel.init({
  name : Sequelize.STRING,
  brand: {
    type      : Sequelize.INTEGER,
    references: {
      model: ShoeBrand,
      key  : 'id'
    }
  }
}, { sequelize, modelName: 'shoe-model' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: ShoeModel
};
