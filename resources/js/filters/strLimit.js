export default (text, length) => {
    const myTruncatedString = text.substring(0,length) +' ...' ;
    return myTruncatedString;
}