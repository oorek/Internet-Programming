const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const songSchema = new Schema({
    rank:{type: Number},
    thumbnailUrl:{type: String},
    title:{type: String},
    artist:{type:String}
});
const Song = mongoose.model('Song', songSchema);

module.exports = Song;