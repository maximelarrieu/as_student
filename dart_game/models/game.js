const mongoose = require('mongoose');
const Schema = mongoose.Schema
console.log(Schema.Types.ObjectId)

const GameSchema = new mongoose.Schema({
  name : {
    type : String,
    required: true,
    lowercase: true,
  },
  mode : {
    type : String,
    required: true,
    lowercase: true,
  },
  status : {
    type: String,
    required: true,
    lowercase: true
  },
  gameplayers: [], 
  currentPlayerId : 
    {type: mongoose.Schema.Types.ObjectId,ref:'Player'}
  ,
  // gameId: [
  //   {type: mongoose.Schema.Types.ObjectId,ref:'GamePlayer'}
  // ],
  // gameId: [
  //   {type: mongoose.Schema.Types.ObjectId,ref:'GameShot'}
  // ]
})

const GameModel = mongoose.model('Game', GameSchema)

module.exports = GameModel
