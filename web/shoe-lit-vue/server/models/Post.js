const Sequelize = require('sequelize');
const sequelize = require('./index.js').default;

const User = require('./User.js').default;
// const Shoe = require('./Shoe.js').default;

class Post extends Sequelize.Model {
  get shoes() {
    return sequelize.query(`
      SELECT
        s.id    as shoe_id,
        sb.name as brand,
        sm.name as model,
        sc.name as colorway
      FROM public."post-relations" AS psr
        LEFT JOIN public."shoes"         as s  ON s.id = psr.shoe
        LEFT JOIN public."shoe-brands"    as sb ON sb.id = s.brand
        LEFT JOIN public."shoe-models"    as sm ON sm.id = s.model
        LEFT JOIN public."shoe-colorways" as sc ON sc.id = s.colorway
      WHERE
        psr.post = 1;`
    );

    // const PostRelations = require('./PostRelations.js').default;

    // return PostRelations.;
  }
}

Post.init({
  user: {
    type      : Sequelize.INTEGER,
    references: {
      model: User,
      key  : 'id'
    }
  },
  postText : Sequelize.TEXT,
  postImage: Sequelize.TEXT

}, { sequelize, modelName: 'post' });

// sequelize.sync({force: true});
sequelize.sync();

module.exports = {
  default: Post
};
