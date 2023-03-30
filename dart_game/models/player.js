const mongoose = require('mongoose');

const PlayerSchema = new mongoose.Schema({
  name : {
    type : String
  },
  email : {
    type : String
  },
  gameWin : {
    type : Number
  },
  gameLost : {
    type : Number
  },
  currentPlayerId : 
    {type: mongoose.Schema.Types.ObjectId,ref:'Game'}
  ,
  gameplayers: 
    {type: mongoose.Schema.Types.ObjectId,ref:'GamePlayer'}
  ,
  // playerId: [
  //   {type: mongoose.Schema.Types.ObjectId,ref:'GameShot'}
  // ]
})

module.exports = mongoose.model('Player', PlayerSchema);
