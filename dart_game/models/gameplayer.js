const mongoose = require('mongoose');

const GamePlayerSchema = new mongoose.Schema({
  remainingShots : {
    type : Number,
  },
  score : {
    type : Number,
  },
  rank : {
    type : Number,
  },
  order : {
    type : Number,
  },
  inGame : {
    type : Boolean,
  },
  playerId : 
    {type: mongoose.Schema.Types.ObjectId,ref:'Player'}
  ,
  gameId: 
    {type: mongoose.Schema.Types.ObjectId,ref:'Game'}
  ,
})
module.exports = mongoose.model('GamePlayer', GamePlayerSchema);
