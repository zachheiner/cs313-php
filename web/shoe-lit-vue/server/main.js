const express      = require('express');
const path         = require('path');
const bodyParser   = require('body-parser');
const session      = require('express-session');
// const cors         = require('cors');
const errorHandler = require('errorhandler');

const verifyLogin = require('./middleware/verifyLogin.js').default;

const loginRoutes = require('./routes/login.js').default;
const shoeRoutes  = require('./routes/shoe.js').default;
const postRoutes  = require('./routes/post.js').default;

// Initiate our app
const app = express();

// app.use(cors());
// app.use(require('morgan')('dev'));

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.use(express.static(path.join(__dirname, '../dist')));
app.use(express.static(path.join(__dirname, '../public')));

app.use(session({ secret: 'shoe-lit-vue', cookie: { maxAge: 60000 }, resave: false, saveUninitialized: false }));

// only use in development
if (process.env.NODE_ENV === 'development')
  app.use(errorHandler());

loginRoutes(app);
shoeRoutes(app);
postRoutes(app);

app.get('/api/test', verifyLogin, (req, res, next) => {
  res.json({ test: 'Sweet test bro' });
});

const port = process.env.PORT || 80;
app.listen(port);
