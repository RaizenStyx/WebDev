let videoGames = [  "God of War",
                    "Halo",
                    "Mass Effect",
                    "Anthem",
                    "Destiny",
                    "Godfall",
                    "Legend of Zelda",
                    "Final Fantasy",
                    "Dragon Age",
                    "Tony Hawk Pro Skater"];

videoGames.push("RockBand");

console.log(videoGames.length);

for(let i = 0; i < videoGames.length; i++){
    console.log(videoGames[i]);
}

videoGames.sort();

console.log(videoGames.toString());

videoGames.reverse();

console.log(videoGames.toString());

console.log(videoGames.splice(1,3,'Skyrim'));

console.log(videoGames);
