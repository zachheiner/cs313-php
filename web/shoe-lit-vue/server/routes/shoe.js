const ShoeColorway = require('../models/ShoeColorway.js').default;
const ShoeBrand    = require('../models/ShoeBrand.js').default;
const ShoeModel    = require('../models/ShoeModel.js').default;
const Shoe         = require('../models/Shoe.js').default;

const LoginMiddleware = require('../middleware/verifyLogin.js').default;

const registerRoutes = (app) => {
  // ----------------------------------
  // Brands
  // ----------------------------------
  app.get('/api/brand', LoginMiddleware, async (req, res, next) => {
    const brands = await ShoeBrand.findAll({attributes: [ 'id', 'name' ]});

    return res.json({status: 'success', brands: brands});
  });

  app.post('/api/brand', LoginMiddleware, async (req, res, next) => {
    if (Reflect.has(req.body, 'name')) {
      if (await ShoeBrand.findOne({where: {name: req.body.name.trim()}}) !== null)
        return res.json({status: 'fail', reason: 'Brand already exists'});

      const brand = await ShoeBrand.create({ name: req.body.name });

      return res.json({
        status: 'success',
        brand : {
          id: brand.id
        }
      });
    }

    return undefined;
  });

  // ----------------------------------
  // Models
  // ----------------------------------
  app.get('/api/model', LoginMiddleware, async (req, res, next) => {
    const models = await ShoeModel.findAll({attributes: [ 'id', 'name' ]});

    return res.json({status: 'success', models: models});
  });

  app.get('/api/model/:brandID', LoginMiddleware, async (req, res, next) => {
    const models = await ShoeModel.findAll({attributes: [ 'id', 'name' ], where: {brand: req.params.brandID}});

    return res.json({status: 'success', models: models});
  });

  app.post('/api/model', LoginMiddleware, async (req, res, next) => {
    if (Reflect.has(req.body, 'brand') && Reflect.has(req.body, 'name')) {
      const shoeBrand = await ShoeBrand.findOne({where: {id: req.body.brand}});
      if (shoeBrand === null)
        return res.json({status: 'fail', reason: "Brand doesn't exist"});

      if (await ShoeModel.findOne({where: {name: req.body.name.trim()}}) !== null)
        return res.json({status: 'fail', reason: 'Model already exists'});

      const model = await ShoeModel.create({
        name : req.body.name,
        brand: shoeBrand.id
      });

      return res.json({
        status: 'success',
        model : {
          id: model.id
        }
      });
    }

    return undefined;
  });

  // ----------------------------------
  // Colorways
  // ----------------------------------
  app.get('/api/colorway', LoginMiddleware, async (req, res, next) => {
    const colorways = await ShoeColorway.findAll({attributes: [ 'id', 'name' ]});

    return res.json({status: 'success', colorways: colorways});
  });

  app.get('/api/colorway/:modelID', LoginMiddleware, async (req, res, next) => {
    const colorways = await ShoeColorway.findAll({attributes: [ 'id', 'name' ], where: {model: req.params.modelID}});

    return res.json({status: 'success', colorways: colorways});
  });

  app.post('/api/colorway', LoginMiddleware, async (req, res, next) => {
    if (Reflect.has(req.body, 'model') && Reflect.has(req.body, 'name')) {
      const shoeModel = await ShoeModel.findOne({where: {id: req.body.model}});
      if (shoeModel === null)
        return res.json({status: 'fail', reason: "Model doesn't exist"});

      if (await ShoeColorway.findOne({where: {name: req.body.name.trim()}}) !== null)
        return res.json({status: 'fail', reason: 'Colorway already exists'});

      const colorway = await ShoeColorway.create({
        name : req.body.name,
        model: shoeModel.id
      });

      return res.json({
        status  : 'success',
        colorway: {
          id: colorway.id
        }
      });
    }

    return undefined;
  });

  // ----------------------------------
  // Shoes
  // ----------------------------------
  app.post('/api/shoe', LoginMiddleware, async (req, res, next) => {
    if (Reflect.has(req.body, 'brand') && Reflect.has(req.body, 'model') && Reflect.has(req.body, 'colorway')) {
      const shoeBrand    = await ShoeBrand.findOne({where: {id: req.body.brand}});
      const shoeModel    = await ShoeModel.findOne({where: {id: req.body.model}});
      const shoeColorway = await ShoeColorway.findOne({where: {id: req.body.colorway}});

      if (shoeBrand === null)
        return res.json({status: 'fail', reason: "Brand doesn't exist"});

      if (shoeModel === null)
        return res.json({status: 'fail', reason: "Model doesn't exist"});

      if (shoeColorway === null)
        return res.json({status: 'fail', reason: "Colorway doesn't exist"});

      let shoe = await Shoe.findOne({where: {
        brand   : shoeBrand.id,
        model   : shoeModel.id,
        colorway: shoeColorway.id
      }});
      if (shoe !== null)
        return res.json({status: 'success', shoe: { id: shoe.id }});

      shoe = await Shoe.create({
        brand   : shoeBrand.id,
        model   : shoeModel.id,
        colorway: shoeColorway.id
      });

      return res.json({
        status: 'success',
        shoe  : { id: shoe.id }
      });
    }

    return undefined;
  });
};

module.exports = {
  default: registerRoutes
};
