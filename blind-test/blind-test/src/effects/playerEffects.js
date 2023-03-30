import { playerActions, playerAvatarUpdated } from "../actions/playerActions";
import api from "../api";

export const getPlayerData = () => (dispatch) => {
  return api.getPlayer().then((data) =>
    dispatch({
      type: playerActions.SET_PLAYER,
      player: data.player,
    })
  );
};

export const updatePlayerAvatar = (avatarUrl) => (dispatch) => {
  return api.updatePlayerAvatar(avatarUrl).then((apiResult) => {
    console.log(apiResult);

    if (apiResult && apiResult.status === "ok") {
      dispatch(playerAvatarUpdated(avatarUrl));
    } else {
      console.log("The avatar upload failed!");
    }
  });
};