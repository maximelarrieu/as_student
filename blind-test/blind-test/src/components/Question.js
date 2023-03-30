import React, { useEffect, useState, Text, Image } from "react";
import { Card, Layout, List, ListItem, Button } from "@material-ui/core";
import ReactAudioPlayer from 'react-audio-player';

const Question = ({ data, chooseAnswer, startTime }) => {
  const [sound, setSound] = useState();
  const makeChoice = (answerIndex) => {
    chooseAnswer({
      questionId: data.id,
      choice: data.answers[answerIndex],
      time: new Date().getTime() - startTime,
    });
  };
  const Answer = ({ answerIndex }) => (
    <Button variant="contained" color="primary"
      style={{ flex: 1, margin: 8 }}
      onClick={() => makeChoice(answerIndex)}
    >
      {data.type === "image" ? (
        <Image
          source={{ uri: data.answers[answerIndex] }}
          style={{ height: 200 }}
          resizeMode="contain"
        />
      ) : (
        <h3>{data.answers[answerIndex]}</h3>
      )}
    </Button>
  );

  return (
    <>
      <h1 category="h5" style={{ textAlign: "center" }}>
        {data.question}
      </h1>
      <>
        <Answer answerIndex={0} />
        <Answer answerIndex={1} />
      </>
      <>
        <Answer answerIndex={2} />
        <Answer answerIndex={3} />
      </>
      <p>
      <ReactAudioPlayer
        src={ data.audio_url}
        autoPlay
        controls
        volume={0.2}
      />
      </p>
    </>
  );
};

export default Question;