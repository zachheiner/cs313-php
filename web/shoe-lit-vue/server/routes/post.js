const multer = require('multer');
const upload = multer({ dest: './public/shoes' });

const LoginMiddleware = require('../middleware/verifyLogin.js').default;

const User = require('../models/User.js').default;
const Post = require('../models/Post.js').default;
const PostRelations = require('../models/PostRelations.js').default;

const registerRoutes = (app) => {
  // ----------------------------------
  // Posts
  // ----------------------------------
  app.get('/api/post', LoginMiddleware, async (req, res, next) => {
    const posts = await Post.findAll();

    const results = [];

    for (let post of posts) {
      const user = await User.findOne({where: {id: post.user}});
      results.push({
        username : user.username,
        avatar   : user.avatar,
        id       : post.id,
        postImage: post.postImage,
        postText : post.postText,
        shoes    : (await post.shoes)[0]
      });
    };

    res.json({
      status: 'success',
      posts : results
    });
  });

  app.post('/api/post', LoginMiddleware, upload.single('picture'), async (req, res, next) => {
    if (
      Reflect.has(req.body, 'shoes') &&
      Reflect.has(req.body, 'postText')
    ) {
      const user = await User.findOne({where: {username: req.session.user}});
      if (user === null)
        return res.json({status: 'fail', reason: 'Invalid user'});

      const shoes = JSON.parse(req.body.shoes);
      if (!Array.isArray(shoes) || shoes.length <= 0)
        return res.json({status: 'fail', reason: 'Must send in at least one shoe'});

      console.log(user);
      console.log(shoes);

      let picturePath = '';
      if (
        req.file !== undefined &&
        req.file !== null &&
        req.file.path !== undefined &&
        req.file.path !== null &&
        req.file.path.trim() !== ''
      )
        picturePath = req.file.path.trim().replace('public/', '');

      console.log(picturePath);

      const post = await Post.create({
        user     : user.id,
        postText : req.body.postText,
        postImage: picturePath
      });

      for (let shoe of shoes) {
        PostRelations.create({
          shoe: shoe,
          post: post.id
        });
      }

      return res.json({
        status: 'success',
        post  : {
          id       : post.id,
          postText : req.body.postText,
          postImage: picturePath

        }
      });
    }

    return undefined;
  });
};

module.exports = {
  default: registerRoutes
};
