const mongoose = require('mongoose');

const GameShotSchema = new mongoose.Schema({
  multiplicator : {
    type : Number
  },
  sector : {
    type : Number
  },
  playerId : [
    {type: mongoose.Schema.Types.ObjectId,ref:'Player'}
  ],
  gameId: [
    {type: mongoose.Schema.Types.ObjectId,ref:'Game'}
  ]
})

module.exports = mongoose.model('GameShot', GameShotSchema);

