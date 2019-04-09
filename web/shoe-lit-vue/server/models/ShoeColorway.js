const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

const ShoeModel = require('./ShoeModel.js').default;

class ShoeColorway extends Sequelize.Model {}

ShoeColorway.init({
  name : Sequelize.STRING,
  model: {
    type      : Sequelize.INTEGER,
    references: {
      model: ShoeModel,
      key  : 'id'
    }
  }
}, { sequelize, modelName: 'shoe-colorway' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: ShoeColorway
};
