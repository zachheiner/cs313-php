const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

const Post = require('./Post.js').default;
const Shoe = require('./Shoe.js').default;

class PostRelations extends Sequelize.Model {}

PostRelations.init({
  post: {
    type      : Sequelize.INTEGER,
    references: {
      model: Post,
      key  : 'id'
    }
  },
  shoe: {
    type      : Sequelize.INTEGER,
    references: {
      model: Shoe,
      key  : 'id'
    }
  }
}, { sequelize, modelName: 'post-relations' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: PostRelations
};
