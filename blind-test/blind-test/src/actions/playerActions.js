export const playerActions = {
    SET_PLAYER: "SET_PLAYER",
    UPDATE_PLAYER_AVATAR: "UPDATE_PLAYER_AVATAR",
    INCREMENT_PLAYER_NB_PLAYED: "INCREMENT_PLAYER_NB_PLAYED",
  };
  
  export const setPlayer = (player) => ({
    type: playerActions.SET_PLAYER,
    player,
  });
  
  export const playerAvatarUpdated = (avatarUrl) => ({
    type: playerActions.UPDATE_PLAYER_AVATAR,
    avatarUrl,
  });
  
  export const incrementPlayerNbPlayed = () => ({
    type: playerActions.INCREMENT_PLAYER_NB_PLAYED,
  });