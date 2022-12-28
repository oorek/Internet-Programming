const router = require('express').Router();
let Song = require('../models/songs.models');

router.route('/').get((req, res) =>{
  Song.find().sort({"rank" : 1})
    .then(song => res.json(song))
    .catch(err => res.status(400).json('Error: ' + err));
});

module.exports = router;