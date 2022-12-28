const router = require('express').Router();
let Song = require('../models/songs.models');

router.route('/').get((req, res) =>{
  console.log(req.query.title);
    Song.find({"title" : req.query.title})
      .then(song => res.json(song))
      .catch(err => res.status(400).json('Error: ' + err));
  });
  
module.exports = router;