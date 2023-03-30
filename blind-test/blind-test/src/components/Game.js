
import React, { useState, Text } from "react";
import { Button } from "@material-ui/core";
import api from "../api";
import { useDispatch } from "react-redux";
import Gameplay from "./GamePlay";
import { incrementPlayerNbPlayed } from "../actions/playerActions";

import '../styles/Home.css'

const Game = ({}) => {
  const [questions, setQuestions] = useState([]);
  const [answers, setAnswers] = useState([]);
  const [score, setScore] = useState(-1);
  const dispatch = useDispatch();
  const getNewGame = () => {
    // Call /questions on the API
    api.getQuestions().then((questions) => {
      if (questions === null) {
        // There was an error
        console.log("Error");
      } else {
        setAnswers([]);
        setScore(-1);
        setQuestions(questions);
        console.log(questions);
      }
    });
  };
  const finishGame = async (answers) => {
    const score = await api.submitAnswers(answers);
    setScore(score);
    setAnswers(answers);
    console.log("Score:", score);
    dispatch(incrementPlayerNbPlayed());
  };
  return (
    <div className="center">
      <h1 style={{ marginBottom: 64 }}>
        BLIND TEST
      </h1>
      {answers && answers.length > 0 ? (
        <>
          <h3>Votre score: {score}</h3>
          <h3>Merci d'avoir joué</h3>
          <Button variant="contained" color="primary" onClick={() => getNewGame()}>New Game</Button>
        </>
      ) : questions && questions.length > 0 ? (
        <Gameplay questions={questions} finishGame={finishGame} />
      ) : (
        <Button variant="contained" color="primary" onClick={() => getNewGame()}>New Game</Button>
      )}
    </div>
  )
};

export default Game;