--lua 实现二分法

function binary_search(array, search, start, final)
    mid = math.floor(((start + final) /2))
    for i=start, final do
        if (array[mid] == search) then
            return mid
        elseif (array[mid] < search) then
            start = mid+1
        else
            final = mid-1
        end
    end

    return binary_search(array, search, start, final)
end

