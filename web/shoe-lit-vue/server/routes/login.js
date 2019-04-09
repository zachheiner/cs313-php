const multer = require('multer');
const upload = multer({ dest: './public/avatars' });

const User = require('../models/User.js').default;

const registerRoutes = (app) => {
  // ----------------------------------
  // Login a user
  // ----------------------------------
  app.post('/api/login', async (req, res, next) => {
    if (
      Reflect.has(req.body, 'username') &&
      Reflect.has(req.body, 'password') &&
      req.body.username.trim() !== '' &&
      req.body.password.trim() !== ''
    ) {
      const user = await User.findOne({where: {username: req.body.username.trim()}});

      if (user === null) return res.json({ status: 'fail', reason: 'Invalid username' });

      if (User.checkPassword(req.body.password.trim(), user.password)) {
        req.session.user = req.body.username;

        console.log(req.session);

        return res.json({
          status: 'success',
          user  : {
            id    : user.id,
            avatar: user.avatar
          }
        });
      }

      return res.json({ status: 'fail', reason: 'Invalid password' });
    } else {
      return res.json({ status: 'fail', reason: 'Need to pass in username and password' });
    }
  });

  // ----------------------------------
  // Logout a user
  // ----------------------------------
  app.post('/api/logout', (req, res, next) => {
    if (Reflect.has(req.session, 'user'))
      delete req.session.user;

    res.json({ status: 'success' });
  });

  // ----------------------------------
  // Create a new user
  // ----------------------------------
  app.post('/api/register', upload.single('avatar'), async (req, res, next) => {
    if (!Reflect.has(req.body, 'username' || req.body.username.trim() === ''))
      return res.json({status: 'fail', reason: 'Must pass in a username'});

    // Test for a user with that name already
    if (await User.findOne({where: {username: req.body.username.trim()}}) !== null)
      return res.json({status: 'fail', reason: 'A user already exists with that username'});

    if (!Reflect.has(req.body, 'password') || req.body.password.trim() === '')
      return res.json({status: 'fail', reason: 'Must pass in a password'});

    if (!Reflect.has(req.body, 'password2') || req.body.password2.trim() === '')
      return res.json({status: 'fail', reason: 'Must pass in a second password'});

    if (req.body.password.trim() !== req.body.password2.trim())
      return res.json({status: 'fail', reason: 'Passwords must match'});

    let avatarPath = '';
    if (
      req.file !== undefined &&
      req.file !== null &&
      req.file.path !== undefined &&
      req.file.path !== null &&
      req.file.path.trim() !== ''
    )
      avatarPath = req.file.path.trim().replace('public/', '');

    const user = await User.create({
      username: req.body.username.trim(),
      password: User.hashPassword(req.body.password),
      avatar  : avatarPath
    });

    return res.json({
      status: 'success',
      user  : {
        id    : user.id,
        avatar: avatarPath
      }
    });
  });
};

module.exports = {
  default: registerRoutes
};
