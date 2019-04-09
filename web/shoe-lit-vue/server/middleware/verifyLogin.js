module.exports = {
  default: (req, res, next) => {
    // if (!Reflect.has(req.session, 'user') || req.session.user.trim() === '')
    //   res.redirect('/#/login');
    // else
    //   next();
    next();
  }
};
