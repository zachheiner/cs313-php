const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

const bcrypt = require('bcrypt');

class User extends Sequelize.Model {
  static get saltRounts() { return 10 }

  static hashPassword(password) {
    return bcrypt.hashSync(password, this.saltRounts);
  }

  static checkPassword(password, hash) {
    return bcrypt.compareSync(password, hash);
  }
}

User.init({
  username: {
    type : Sequelize.STRING,
    field: 'user_name'
  },
  password: Sequelize.TEXT,
  avatar  : Sequelize.TEXT
}, { sequelize, modelName: 'user' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: User
};
